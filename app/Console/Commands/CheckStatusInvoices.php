<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckStatusInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-status-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el estado de las facturas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoices = Invoice::where('status', 'PENDING')->get();

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/CRON-jobs-log.log'),
        ])->info(json_encode($invoices));
        // Escribe aquí tu lógica
        $this->info('El comando se ejecutó correctamente.');

        return Command::SUCCESS;
    }
}
