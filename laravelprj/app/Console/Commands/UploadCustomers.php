<?php
namespace App\Console\Commands;

use App\Services\Customer\CustomerService;
use App\Services\UploadFiles\CSVLoader;
use Illuminate\Console\Command;

class UploadCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:upload {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload customers from file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $fileName = $this->argument('fileName');
        
        $base_url =  storage_path();
        $customers_upload_url = '/app/public/customers/uploads';
        $filePath = "$base_url/$customers_upload_url/$fileName";        
        
        $CSVdata = new CSVLoader($filePath);
            $headersAr = $CSVdata->getHeaders();
            $dataAr = $CSVdata->getData();

        $customerService = new CustomerService($dataAr);        
            $customerService->clearCustomers();
            $customerService->fillCustomers($dataAr);        
            $headersAr = $customerService->getHeaders();
            $dataAr = $customerService->getData();
     
        $this->table(            
            $headersAr,
            $dataAr
        );
    }
}
