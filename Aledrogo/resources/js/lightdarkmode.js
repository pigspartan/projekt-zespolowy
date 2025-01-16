// Toggle dark mode
const toggleDarkMode = () => {
    const htmlElement = document.documentElement;
    const toggleButton = document.getElementById("toggleMode");
    if (htmlElement.classList.contains('dark')) {
        htmlElement.classList.remove('dark');
        document.cookie="theme=light"
        localStorage.setItem('theme', 'light');
        toggleButton.innerHTML = "Tryb ciemny";
    } else {
        htmlElement.classList.add('dark');
        document.cookie="theme=dark"
        localStorage.setItem('theme', 'dark');
        toggleButton.innerHTML = "Tryb jasny";
    }
};

// Apply the saved theme on page load
const savedTheme = localStorage.getItem('theme');
const toggleButton = document.getElementById("toggleMode");
toggleButton.addEventListener("click", () => toggleDarkMode());

if (savedTheme === 'dark') {
    toggleButton.innerHTML = "Tryb jasny";
} else {
    toggleButton.innerHTML = "Tryb ciemny";
}

