<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Visit | CheckMate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        :root {
            --primary-color: #004080;
            --secondary-color: #ffcc00;
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-secondary {
            background-color: var(--secondary-color);
        }

        .text-secondary {
            color: var(--secondary-color);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-primary text-white py-4">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold">CheckMate</h1>
            <img src="{{ asset('images/download.jfif') }}" alt="Alupe University Logo" class="h-12">
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 h-screen flex flex-col justify-between">
        <section class="bg-white shadow-lg rounded-lg p-6 flex-1 overflow-y-auto">
            <h2 class="text-2xl font-bold text-primary mb-4">Book a Visit</h2>
            <form action="{{ route('book.visit.submit') }}" method="POST">
                @csrf
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="first_name">First Name</label>
                        <input type="text" class="border p-2 rounded w-full" id="first_name" name="first_name" required>
                    </div>
                    <div class="flex-1">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="border p-2 rounded w-full" id="last_name" name="last_name" required>
                    </div>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="designation">Designation</label>
                        <input type="text" class="border p-2 rounded w-full" id="designation" name="designation" required>
                    </div>
                    <div class="flex-1">
                        <label for="organization">Organization</label>
                        <input type="text" class="border p-2 rounded w-full" id="organization" name="organization" required>
                    </div>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="email">Email</label>
                        <input type="email" class="border p-2 rounded w-full" id="email" name="email" required>
                    </div>
                    <div class="flex-1">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="border p-2 rounded w-full" id="phone_number" name="phone_number" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="id_number">ID Number</label>
                    <input type="text" class="border p-2 rounded w-full" id="id_number" name="id_number" required>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="visit_type">Visit Type</label>
                        <select class="border p-2 rounded w-full" id="visit_type" name="visit_type" required>
                            <option value="">Select Visit Type</option>
                            <option value="Business">Business</option>
                            <option value="Official">Official</option>
                            <option value="Educational">Educational</option>
                            <option value="Social">Social</option>
                            <option value="Tour">Tour</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="visit_facility">Visit Facility</label>
                        <select class="border p-2 rounded w-full" id="visit_facility" name="visit_facility" required>
                            <option value="">Select Visit Facility</option>
                            <option value="Library">Library</option>
                            <option value="Administration Block">Administration Block</option>
                            <option value="Science Block">Science Block</option>
                            <option value="Auditorium">Auditorium</option>
                            <option value="SHS">SHS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="visit_date">Visit Date</label>
                    <input type="date" class="border p-2 rounded w-full" id="visit_date" name="visit_date" required>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="visit_from">Visit From</label>
                        <input type="time" class="border p-2 rounded w-full" id="visit_from" name="visit_from" required>
                    </div>
                    <div class="flex-1">
                        <label for="visit_to">Visit To</label>
                        <input type="time" class="border p-2 rounded w-full" id="visit_to" name="visit_to" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="purpose_of_visit">Purpose of Visit</label>
                    <textarea class="border p-2 rounded w-full" id="purpose_of_visit" name="purpose_of_visit" required></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="host_name">Host Name</label>
                    <select class="border p-2 rounded w-full" id="host_name" name="host_name" required>
                        <option value="">Select Host Name</option>
                        <option value="Prof. Barasa Lwagula">Prof. Barasa Lwagula</option>
                        <option value="Prof. John Changach">Prof. John Changach</option>
                        <option value="Dr. Titus Muhambe">Dr. Titus Muhambe</option>
                        <option value="Dr. Bostley Asenahabi D.K. Muyobo">Dr. Bostley Asenahabi</option>
                        <option value="Dr. D.K Muyobo">Dr. D.K Muyobo</option>
                    </select>
                </div>
                <div class="flex justify-center space-x-4 mb-4 mt-4">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Submit</button>
                    <a href="{{ route('index') }}" class="bg-secondary text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Alupe University. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>