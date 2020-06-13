<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class clearAttachment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:attachment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear attachments if greater than 15 minutes';

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
			$prefix_path = 'public/attachment/';
			$list = Storage::allFiles($prefix_path);
			for($i=0;$i<count($list);$i++){
				$last_modified = Storage::lastModified($list[$i]);
				if((time()-$last_modified)>900){ //1 menit = 60
					//$waktu[] = 'time:'.time().',modified:'.$last_modified.',selisih:'.(time()-$last_modified);
					Storage::delete($list[$i]);
				}
			}
			//return response()->json(['status' => 'success']);
		} catch(Exception $e){
			//return response()->json(['status' => 'error']);
		}
    }
}
