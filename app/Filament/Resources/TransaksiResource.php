<?php

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;

class LaporanTransaksi extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationLabel = 'Laporan Transaksi';
    protected static string $view = 'filament.pages.laporan-transaksi';

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getFilteredQuery())
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('tanggal')->date(),
                TextColumn::make('total'),
            ])
            ->filters([
                // Optional: Bisa juga buat preset filter
            ])
            ->headerActions([]);
    }

    protected function getFilteredQuery(): Builder
    {
        $start = request()->input('start_date');
        $end = request()->input('end_date');

        $query = Transaksi::query();

        if ($start && $end) {
            $query->whereBetween('tanggal', [$start, $end]);
        }

        return $query;
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('start_date')
                ->label('Dari Tanggal')
                ->default(now()->startOfMonth()),
            Forms\Components\DatePicker::make('end_date')
                ->label('Sampai Tanggal')
                ->default(now()),
        ];
    }
}
