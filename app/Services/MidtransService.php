<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_ENVIRONMENT') === 'production';
    }

    // Fungsi untuk membuat transaksi Midtrans
    public function createTransaction($orderDetails)
    {
        // Parameter transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderDetails['order_id'],
                'gross_amount' => $orderDetails['gross_amount'],
            ],
            'customer_details' => [
                'first_name' => $orderDetails['customer_name'],
                'email' => $orderDetails['customer_email'],
                'phone' => $orderDetails['customer_phone'],
            ],
            'shipping_address' => $orderDetails['shipping_address'],
        ];

        try {
            // Membuat transaksi dan mendapatkan URL pembayaran
            $transaction = Snap::createTransaction($params);
            return $transaction->redirect_url;
        } catch (\Exception $e) {
            throw new \Exception("Error creating Midtrans transaction: " . $e->getMessage());
        }
    }

    // Fungsi untuk memverifikasi status pembayaran
    public function handleCallback(array $callbackData)
    {
        $transactionStatus = $callbackData['transaction_status'] ?? null;
        $orderId = $callbackData['order_id'] ?? null;

        if (!$orderId || !$transactionStatus) {
            return false;
        }

        $order = Order::where('transaction_id', $orderId)->first();
        if (!$order) {
            return false;
        }

        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $order->update(['payment_status' => 'paid']);
                break;

            case 'pending':
                $order->update(['payment_status' => 'pending']);
                break;

            case 'deny':
            case 'cancel':
            case 'expire':
                $order->update(['payment_status' => 'failed']);
                break;
        }

        return true;
    }

    public function refundTransaction(string $orderId, int $amount)
    {
        try {
            $refundResponse = Transaction::refund($orderId, $amount);
            return $refundResponse;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}