<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is socket server start command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");


        // set some variables
        global $thread_count;
        $host = "127.0.0.1";
        $port = 25003;
        // don't timeout!
        set_time_limit(0);
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        
        $result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
        $threads = [];
        // start listening for connections
        $result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

        while(True){ 
            print ("Multithreaded Php server : Waiting for connections from TCP clients...\n");
            $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
            //$t = new ClientThread;
            $t = new ClientThread;
            $t->run($spawn);
            //array_push($threads,$t);
        }
        return 0;
    }
}

 function check_data_from_ulr($imei){
    $response = file_get_contents('https://esp32-user-default-rtdb.firebaseio.com/.json');
    $data = json_decode($response);
    if (array_key_exists((int)$imei,(array)$data))
    {
        return true;
    }
    else
    {
        return false;
    }
    die;
}

Class ClientThread
{
    //public $imei;
    public $thread_count;
    function __construct() {
        $this->thread_count +=1;
        \Log::info ("[+] New server socket on thread ".$this->thread_count." started for "); 
    }

    function run($spawn){
        $input = socket_read($spawn, 1024) or die("Could not read input\n");
        if($input != null){
            $chk = $this->check_data_from_ulr($input);
            if($chk){
            while(true){
                $input = socket_read($spawn, 1024) or die("Could not read input\n");
                \Log::info($input);
            }
            }else{
            socket_write($spawn,"You entered IMEI ".$input." is in correct") or die("Could not write output\n");
            // close sockets
                socket_close($spawn);
                //socket_close($socket);
            die;
            }
        }else{
        socket_write($spawn,"please enter input") or die("Could not write output\n");
        // close sockets
            socket_close($spawn);
            //socket_close($socket);
        die;
        }
    }
    

}