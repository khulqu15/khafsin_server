<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Khafsin App</title>

        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
    </head>
    <body>
        <div class="container mx-auto w-full min-h-screen py-12 px-8">
            <div class="w-full grid grid-cols-8 gap-4">
                <div class="md:col-span-2 col-span-8 space-y-3">
                    <h2 class="text-xl font-bold">Options</h2>
                    <button class="btn btn-primary w-full text-white">Upload Excel</button>
                    <button class="btn btn-primary w-full text-white">Export to Excel</button>
                    <button class="btn btn-error w-full text-white">Delete All</button>
                </div>
                <div class="md:col-span-6 col-span-8">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold">Data</h2>
                    </div>
                    <div class="h-[80vh] w-full overflow-auto">
                        <table class="table table-xs">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Datetime</th>
                                <th>X</th>
                                <th>Y</th>
                                <th>Z</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($imus as $imu)
                                  <tr data-id="{{ $imu->id }}">
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $imu->created_at }}</th>
                                    <td>{{ $imu->x }}</td>
                                    <td>{{ $imu->y }}</td>
                                    <td>{{ $imu->z }}</td>
                                    <td>{{ $imu->location ?? 'N/A' }}</td>
                                    <td>{{ $imu->x >= 0.5 ? 'Good' : 'Bad' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-error text-white">Delete</button>
                                    </td>
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="8" class="text-center">No data available.</td>
                                  </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">

        const pusher = new Pusher('256c4a1be1f9dffd2dc7', {
            cluster: 'ap1'
        });

        const channel = pusher.subscribe('imu-data');

        channel.bind('add-imu', function(event) {
            const imu = event.imu;
            console.log('IMU Added:', imu);

            const tableBody = document.querySelector('tbody');
            const newRow = `
                <tr data-id="${imu.id}">
                    <td>${imu.id}</td>
                    <td>${imu.created_at}</td>
                    <td>${imu.x}</td>
                    <td>${imu.y}</td>
                    <td>${imu.z}</td>
                    <td>${imu.location ?? 'N/A'}</td>
                    <td>${imu.status ?? 'N/A'}</td>
                    <td>
                        <button class="btn btn-sm btn-error text-white">Delete</button>
                    </td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', newRow);
        });

        channel.bind('delete-imu', function(event) {
            const imuId = event.imuId;
            console.log('IMU Deleted:', imuId);

            const imuRow = document.querySelector(`tr[data-id="${imuId}"]`);
            if (imuRow) {
                imuRow.remove();
            }
        });

        function deleteImu(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            fetch(`/imus/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    document.querySelector(`tr[data-id='${id}']`).remove();
                    alert(data.message);
                } else {
                    alert('Error deleting the record.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    </script>
</html>
