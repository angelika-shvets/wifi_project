<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Network test</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="application/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="application/javascript" src="js/network.js"></script>
    </head>
    <body>
    <div class="container">
        <div class="content">
        <h2>Create Network</h2>
        <form class=create_network" name ="create_network" novalidate="novalidate" action="" method="POST">

            <div class="input_container">
                <div class="input_content">
                    <input type="text" placeholder="Network ID" name="network_id" class=""/>
                </div>
                <div class="input_content">
                    <input type="text" placeholder="throughput" name="throughput" class=""/>
                </div>

                <div  class="input_content">

                    <select name ="auth">
                        <option value="PUBLIC">Public</option>
                        <option value="WPA">WPA</option>
                    </select>
                </div>

                <div class="input_content">
                    <select name ="device_id">
                        @foreach($devices as $device)
                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="submit">
                <button type="submit" class="create_network_submit" >Create Network</button>
            </div>
            <p class="response_create_network"></p>
        </form>
        </div>
        <div class="content">
            <h2>Add New Device To Network</h2>
            <form class=update_device" name ="add_new_device_to_network" novalidate="novalidate" action="" method="POST">

                <div class="input_container">
                    <div class="input_content">
                        <select name ="id">
                            @foreach($networks as $network)
                                <option value="{{ $network->id }}">{{ $network->network_id }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="input_content">
                        <select name ="device_id">
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="submit">
                    <button type="submit" class="add_new_device_to_network_submit" >Add Device</button>
                </div>
                <p class="response_update_device"></p>
            </form>
        </div>
    </div>

    </body>
</html>
