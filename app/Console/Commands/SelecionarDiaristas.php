<?php

namespace App\Console\Commands;

use App\Actions\Diaria\EscolheDiarista\SelecionaAutomaticamente;
use Illuminate\Console\Command;

class SelecionarDiaristas extends Command
{
    // The name and signature of the console command.
    protected $signature = 'diarias:selecionar:diaristas';

    // The console command description.
    protected $description = 'Verifica as diárias com mais de 24 horas e seleciona o diarista mais apropriado';

    // Create a new command instance.
    public function __construct(
        private SelecionaAutomaticamente $selecionaAutomaticamente
    ) {
        parent::__construct();
    }

    // Busca as diárias pagas com mais de 24 horas de criação e escolhe o(a) diarista mais aproprido
    public function handle()
    {
        $this->selecionaAutomaticamente->executar();

        return 0;
    }
}
