<script>
    (function () {
        const theme = localStorage.getItem('theme');

        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        window.toggleTheme = function () {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        };
    })();
</script>