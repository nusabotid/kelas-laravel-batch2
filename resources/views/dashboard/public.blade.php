<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard IoT</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 40px;
            display: block;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            width: 100%;
        }

        .card {
            flex: 1;
            border-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 20px;
            color: #333;
        }

        .card p {
            color: #666;
            margin-top: 10px;
        }

        #inputServo {
            width: 100%;
            margin: 15px 0;
        }

        #inputLcdText {
            display: block;
            width: 100%;
            outline: none;
            border: 1px solid salmon;
            padding: 8px;
            border-radius: 3px;
            margin: 15px 0;
        }

        #submitBtn {
            padding: 7px 12px;
            border-radius: 3px;
            background-color: salmon;
            color: white;
            outline: none;
            border: 1px solid salmon;
            cursor: pointer;
        }

        .online {
            color: lightgreen;
        }

        .offline {
            color: red;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        td {
            color: #666;
        }
    </style>
</head>
<body>
    <main>
        <section class="container">
            <div style="margin-bottom: 30px; text-align: center;">
                <h1>Dashboard IoT</h1>
            </div>

            <div class="card-container">
                <div class="card">
                    <h3>Suhu</h3>
                    <p><span id="suhu">?</span>°C</p>
                </div>
                <div class="card">
                    <h3>Kelembapan</h3>
                    <p><span id="kelembapan">?</span>%</p>
                </div>
                <div class="card">
                    <h3>Posisi Servo</h3>
                    <input type="range" name="slider" id="inputServo" min="0" max="180" value="90" onmouseup="publishServo()">
                    <p id="textServo">?°</p>
                </div>
                <div class="card">
                    <h3>Display LCD</h3>
                    <input type="text" name="lcd_text" id="inputLcdText" placeholder="Masukan Teks">
                    <button id="submitBtn">Kirim</button>
                </div>
            </div>

            <div class="table-container">
                <div style="margin: 20px 0; text-align: center;">
                    <h3>Data Perangkat</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->serial_number }}</td>
                                <td>
                                    <span class="offline" id="{{ $device->serial_number }}">Tidak Diketahui</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const clientId = Math.random().toString(36).substring(2, 15);
        const host = 'wss://broker.emqx.io:8084/mqtt';
        const options = {
            keepalive: 30,
            clientId: clientId,
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000
        }
        console.log("Menghubungkan ke server");
        const client = mqtt.connect(host, options);

        client.on('connect', () => {
            console.log("Terhubung ke server");
            client.subscribe('nusabot/#', 1);
        });

        const inputServo = document.getElementById('inputServo');
        const textServo = document.getElementById('textServo');

        inputServo.addEventListener('input', () => {
            textServo.textContent = inputServo.value + '°';
        });

        const inputLcdText = document.getElementById('inputLcdText');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', () => {
            alert(inputLcdText.value);
            client.publish('nusabot/lcd', inputLcdText.value, { qos: 1, retain: true });
        });

        function publishServo() {
            client.publish('nusabot/servo', inputServo.value, { qos: 1, retain: true });
        }

        client.on('message', (topic, message) => {
            console.log(topic, message.toString());

            if(topic === 'nusabot/suhu') {
                document.getElementById('suhu').innerHTML = message.toString();
            }
            if(topic === 'nusabot/kelembapan') {
                document.getElementById('kelembapan').innerHTML = message.toString();
            }
            if(topic === 'nusabot/servo') {
                textServo.textContent = message.toString() + '°';
                inputServo.value = message.toString();
            }
            if(topic === 'nusabot/lcd'){
                inputLcdText.value = message.toString();
            }

            @foreach ($devices as $device)
                if(topic === 'nusabot/{{ $device->serial_number }}') {
                    document.getElementById('{{ $device->serial_number }}').innerHTML = message.toString();
                    if(message.toString() === 'Online') {
                        document.getElementById('{{ $device->serial_number }}').classList.remove('offline');
                        document.getElementById('{{ $device->serial_number }}').classList.add('online');
                    } else {
                        document.getElementById('{{ $device->serial_number }}').classList.remove('online');
                        document.getElementById('{{ $device->serial_number }}').classList.add('offline');
                    }
                }
            @endforeach
        });
    </script>
</body>
</html>
