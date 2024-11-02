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
                    <p>25°C</p>
                </div>
                <div class="card">
                    <h3>Kelembapan</h3>
                    <p>60%</p>
                </div>
                <div class="card">
                    <h3>Posisi Servo</h3>
                    <input type="range" name="slider" id="inputServo" min="0" max="180" value="90">
                    <p id="textServo">90°</p>
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
                            <th>ID Perangkat</th>
                            <th>Status Perangkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->serial_number }}</td>
                                <td>
                                    <span class="online">Online</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        const inputServo = document.getElementById('inputServo');
        const textServo = document.getElementById('textServo');

        inputServo.addEventListener('input', () => {
            textServo.textContent = inputServo.value + '°';
        });

        const inputLcdText = document.getElementById('inputLcdText');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', () => {
            alert(inputLcdText.value);
            inputLcdText.value = '';
        });
    </script>
</body>
</html>
