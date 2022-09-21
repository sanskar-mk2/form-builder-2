<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Enums\SurveyStatus;
use App\Filament\Resources\SurveyResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSurvey extends ViewRecord
{
    protected static string $resource = SurveyResource::class;

    protected function getActions(): array
    {
        $ret = [];
        if ($this->record->status == SurveyStatus::Unpublished->value) {
            $ret[] = Actions\Action::make('publish')
                ->action('publish')
                ->requiresConfirmation();
        } elseif ($this->record->status == SurveyStatus::Published->value) {
            $ret[] = Actions\Action::make('mark_completed')
                ->action('mark_completed')
                ->requiresConfirmation();
        } else;

        return [
            Actions\EditAction::make(),
            ...$ret,
        ];
    }

    public function publish()
    {
        $this->record->status = SurveyStatus::Published->value;
        $this->record->save();

        Notification::make()
            ->title('Published Survey: '.$this->record->name)
            ->success()
            ->send();
        $this->redirect($this->getResource()::getUrl('index'));
    }

    public function mark_completed()
    {
        $this->record->status = SurveyStatus::Completed->value;
        $this->record->save();

        Notification::make()
            ->title('Survey Marked Done: '.$this->record->name)
            ->success()
            ->send();
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
