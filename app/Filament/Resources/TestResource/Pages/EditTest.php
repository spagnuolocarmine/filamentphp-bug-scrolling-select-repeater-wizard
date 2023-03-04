<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Models\SubItem;
use Filament\Pages\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use App\Filament\Resources\TestResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\Wizard\Step;

class EditTest extends EditRecord
{
    use EditRecord\Concerns\HasWizard;

    protected static string $resource = TestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSteps(): array
    {
        return [
            Step::make('Evento')
            ->description('Informazioni genereli sull\'evento')
            ->schema([
                Repeater::make('items')
                // ->relationship('moments', fn (Builder $query) => $query->where('moment_id', 'like', 'T%'))
                ->relationship()
                ->schema([
                        Select::make('sub_items_id')
                            // ->label('Sub Item')
                            ->options(SubItem::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                                                         
                            ->preload()
                            ->reactive(),
                ])
                ->orderable()
                ->disableLabel()
                ->defaultItems(0),
            ]),
           
        ];
    }
}
