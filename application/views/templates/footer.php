    </main>

    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Deteksi Pneumonia X-Ray. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Theme toggle functionality
        function toggleTheme() {
            const html = document.documentElement;
            const themeSwitch = document.querySelector('.theme-switch i');
            
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                themeSwitch.className = 'fa fa-sun';
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                themeSwitch.className = 'fa fa-moon';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const html = document.documentElement;
            const themeSwitch = document.querySelector('.theme-switch i');
            
            html.setAttribute('data-bs-theme', savedTheme);
            themeSwitch.className = savedTheme === 'dark' ? 'fa fa-moon' : 'fa fa-sun';
        });
    </script>
</body>
</html> 