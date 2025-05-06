<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Arsi University Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#002f66',
                        accent: '#FF6600',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        },
                        pulseSlow: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.03)' },
                        }
                    },
                    animation: {
                        fadeInUp: 'fadeInUp 1s ease-out',
                        pulseSlow: 'pulseSlow 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center text-center p-6 bg-gradient-to-b from-white to-gray-100">
        <!-- Header -->
        <div class="mb-10 animate-fadeInUp">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-2">🎓 Arsi University Job Portal</h1>
            <p class="text-lg text-gray-600">Where Opportunities Meet Ambition</p>
        </div>

        <!-- Mission, Vision, Goal Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 w-full max-w-5xl animate-fadeInUp">
            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-accent hover:shadow-xl transition duration-300">
                <h2 class="text-xl font-bold text-primary mb-2">🎯 Mission</h2>
                <p>To empower students with access to life-changing job opportunities through innovation, partnerships, and digital platforms.</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-accent hover:shadow-xl transition duration-300">
                <h2 class="text-xl font-bold text-primary mb-2">👁 Vision</h2>
                <p>To be a leading hub for graduate career success, connecting education with real-world employment pathways.</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-accent hover:shadow-xl transition duration-300">
                <h2 class="text-xl font-bold text-primary mb-2">🏆 Goal</h2>
                <p>To facilitate a seamless bridge between students, alumni, and employers through a smart and intuitive job-matching system.</p>
            </div>
        </div>

        <!-- Call-to-Action Buttons -->
        <div class="space-x-4 animate-fadeInUp">
            <a href="/login"
               class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-300 shadow-md animate-pulseSlow">
               🔐 Login
            </a>

            <a href="/register"
               class="bg-accent text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 shadow-md animate-pulseSlow">
               📝 Register
            </a>
        </div>

        <!-- Footer -->
        <footer class="mt-12 text-sm text-gray-500">
            &copy; {{ date('Y') }} Arsi University | All Rights Reserved
        </footer>
    </div>

</body>
</html>
