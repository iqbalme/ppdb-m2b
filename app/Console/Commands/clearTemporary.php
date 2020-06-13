<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class clearTemporary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:temporary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all temporary files within 15 hours';

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
     * @return mixed
     */
    public function handle()
    {
        try{
			$prefix_path = 'public/temporary/';
			$list = Storage::allFiles($prefix_path);
			foreach($list as $file){
				$last_modified = Storage::lastModified($file);
				if((time()-$last_modified)>10800){ //1 menit = 60 // 15 jam kemudian
					Storage::delete($file);
				}
			}
			//return response()->json(['status' => 'success']);
		} catch(Exception $e){
			//return response()->json(['status' => 'error']);
		}
    }
}
