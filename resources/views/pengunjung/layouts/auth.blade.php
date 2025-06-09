{{-- resources/views/pengunjung/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'rimbacamp')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome untuk icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.4);
            }

            50% {
                box-shadow: 0 0 30px rgba(34, 197, 94, 0.6);
            }
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-fade-in {
            animation: fadeInUp 1s ease-out;
        }

        .animate-slide-up {
            animation: slideInLeft 0.8s ease-out;
        }

        .animate-pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite;
        }

        .glass-effect {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 25%, #047857 50%, #059669 75%, #10b981 100%);
            background-size: 300% 300%;
            animation: gradientShift 8s ease infinite;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .leaf-bounce:hover {
            transform: rotate(10deg) scale(1.1);
            transition: all 0.3s ease;
        }
    </style>

    @stack('styles')
</head>

<body class="gradient-bg font-sans antialiased min-h-screen relative overflow-y-auto">
    {{-- Background decoration - Floating Nature Elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-8 h-8 text-green-300 opacity-30 animate-float">
            <i class="fas fa-leaf text-2xl leaf-bounce"></i>
        </div>
        <div class="absolute top-32 right-20 w-6 h-6 text-emerald-300 opacity-25 animate-float"
            style="animation-delay: 1s;">
            <i class="fas fa-seedling text-xl leaf-bounce"></i>
        </div>
        <div class="absolute bottom-20 left-32 w-10 h-10 text-green-400 opacity-35 animate-float"
            style="animation-delay: 2s;">
            <i class="fas fa-tree text-3xl leaf-bounce"></i>
        </div>
        <div class="absolute bottom-32 right-10 w-7 h-7 text-emerald-400 opacity-30 animate-float"
            style="animation-delay: 3s;">
            <i class="fas fa-leaf text-2xl leaf-bounce"></i>
        </div>
        <div class="absolute top-1/2 left-1/4 w-5 h-5 text-green-500 opacity-20 animate-float"
            style="animation-delay: 4s;">
            <i class="fas fa-spa text-lg leaf-bounce"></i>
        </div>

        {{-- Animated Circles --}}
        <div class="absolute top-20 right-40 w-32 h-32 bg-green-500 bg-opacity-15 rounded-full animate-pulse"></div>
        <div class="absolute bottom-40 left-20 w-24 h-24 bg-emerald-500 bg-opacity-15 rounded-full animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-10 w-16 h-16 bg-green-400 bg-opacity-10 rounded-full animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <main class="relative z-10 min-h-screen flex items-center justify-center">
        <div class="w-full px-6 md:max-w-2xl lg:max-w-3xl">
            @yield('content')
        </div>

    </main>

    <script>
        // Add interactive effects to layout
        document.addEventListener('DOMContentLoaded', function() {
            // Parallax effect for floating elements
            document.addEventListener('mousemove', function(e) {
                const leaves = document.querySelectorAll('.animate-float');
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;

                leaves.forEach((leaf, index) => {
                    const speed = (index + 1) * 0.5;
                    const x = (mouseX - 0.5) * speed;
                    const y = (mouseY - 0.5) * speed;
                    leaf.style.transform =
                        `translate(${x}px, ${y}px) translateY(${Math.sin(Date.now() * 0.001 + index) * 15}px)`;
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
