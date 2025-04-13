<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')
                ->label('Status Pengiriman')
                    ->options([
                        'Pending' => 'Pending',
                        'proses' => 'proses',
                        'Dikirim' => 'Dikirim',
                        'Komplain' => 'Komplain',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),
                // Forms\Components\Textarea::make('alamat_pengiriman')
                //     ->default('user.alamat')
                //     ->required()
                //     ->columnSpanFull(),
                Forms\Components\TextInput::make('status_pembayaran')
                ->label('Status Pembayaran')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->sortable(),
                TextColumn::make('total_harga')->money('IDR')->sortable(),
                TextColumn::make('status')->searchable()->label('Pengiriman'),
                TextColumn::make('status_pembayaran')->label('Pembayaran'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Tanggal Order')
                    ->form([
                        DatePicker::make('from')->label('Dari'),
                        DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),

                Filter::make('status')
                    ->form([
                        Forms\Components\Select::make('value')
                            ->label('Status')
                            ->options([
                                'Pending' => 'Pending',
                                'Dikirim' => 'Dikirim',
                                'Selesai' => 'Selesai',
                            ])
                            ->placeholder('Semua')
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], fn($q) => $q->where('status', $data['value']));
                    }),

                Filter::make('status_pembayaran')
                    ->form([
                        Forms\Components\Select::make('value')
                            ->label('Status Pembayaran')
                            ->options([
                                'Pending' => 'Belum Bayar',
                                'Dibayar' => 'Sudah Bayar',
                                'Gagal' => 'Gagal',
                                'Selesai' => 'Selesai',
                            ])
                            ->placeholder('Semua')
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], fn($q) => $q->where('status_pembayaran', $data['value']));
                    }),
            ])
            ->headerActions([
                Action::make('exportPdf')
                    ->label('Export PDF')
                    ->color('primary')
                    ->action(function ($livewire) {
                        $filters = $livewire->getTableFiltersForm()->getState();

                        $query = Order::query();

                        if (!empty($filters['created_at']['from'])) {
                            $query->whereDate('created_at', '>=', $filters['created_at']['from']);
                        }

                        if (!empty($filters['created_at']['until'])) {
                            $query->whereDate('created_at', '<=', $filters['created_at']['until']);
                        }

                        if (!empty($filters['status']['value'])) {
                            $query->where('status', $filters['status']['value']);
                        }

                        if (!empty($filters['status_pembayaran']['value'])) {
                            $query->where('status_pembayaran', $filters['status_pembayaran']['value']);
                        }

                        // $data = $query->get();
                        $data = $query->with('user')->get();
                        $grandTotal = $data->sum('total_harga');
                        $pdf = Pdf::loadView('laporan.lap_pdf', [
                            'data' => $data,
                            'start' => $filters['created_at']['from'] ?? null,
                            'end' => $filters['created_at']['until'] ?? null,
                            'grandTotal' => $grandTotal,
                        ]);

                        return response()->streamDownload(
                            fn() => print ($pdf->stream()),
                            'Lap ' . $filters['created_at']['from'] . ' sampai ' . $filters['created_at']['until'] . '.pdf'
                        );



                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderDetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
