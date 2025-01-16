// Toggle dark mode
const toggleDarkMode = () => {
    const htmlElement = document.documentElement;
    const toggleButton = document.getElementById("toggleMode");
    if (htmlElement.classList.contains('dark')) {
        htmlElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        toggleButton.innerHTML = "Tryb ciemny";
    } else {
        htmlElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        toggleButton.innerHTML = "Tryb jasny";
    }
};

// Apply the saved theme on page load
const savedTheme = localStorage.getItem('theme');
const toggleButton = document.getElementById("toggleMode");
toggleButton.addEventListener("click", () => toggleDarkMode());
if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
    toggleButton.innerHTML = "Tryb jasny";
} else {
    document.documentElement.classList.remove('dark');
    toggleButton.innerHTML = "Tryb ciemny";
}

