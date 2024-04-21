import './bootstrap';

// Toggle dark/light mode
Alpine.store('darkMode', {
    on: false,
    applyTheme(theme) {
        const themeClass = 'dark';
        document.documentElement.classList.toggle(themeClass, theme === themeClass);
        localStorage.setItem('theme', theme);
    },
    toggle() {
        console.log("Toggle clicked");
        this.on = !this.on;
        this.applyTheme(this.on ? 'dark' : 'light');
    },
    init() {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        this.on = localStorage.theme === 'dark' || (!('theme' in localStorage) && prefersDark);
        this.applyTheme(this.on ? 'dark' : 'light');
    }
});

// ToolTip
document.addEventListener('alpine:init', () => {
    // Magic: $tooltip
    Alpine.magic('tooltip', el => message => {
        let instance = tippy(el, { content: message, trigger: 'manual' })

        instance.show()

        setTimeout(() => {
            instance.hide()

            setTimeout(() => instance.destroy(), 150)
        }, 2000)
    })

    // Directive: x-tooltip
    Alpine.directive('tooltip', (el, { expression }) => {
        tippy(el, { content: expression })
    })
})
