<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Khafsin App</title>

        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="container mx-auto w-full min-h-screen py-12 px-8">
            <div class="w-full grid grid-cols-8 gap-4">
                <div class="md:col-span-2 col-span-8 space-y-3">
                    <h2 class="text-xl font-bold">Options</h2>
                    <button class="btn btn-primary w-full text-white">Export to Excel</button>
                    <button class="btn btn-error w-full text-white">Delete All</button>
                </div>
                <div class="md:col-span-6 col-span-8">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold">Options</h2>
                        <button class="btn btn-base-200 text-white">Sort</button>
                    </div>
                    <div class="h-[85vh] bg-primary w-full"></div>
                </div>
            </div>
        </div>
    </body>
</html>
