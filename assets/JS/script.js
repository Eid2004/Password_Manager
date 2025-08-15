// Password strength checker - BAR ONLY (no text messages)
function checkPasswordStrength(password) {
    let strength = 0;

    // Length check
    if (password.length >= 8) {
        strength += 1;
    }

    // Uppercase check
    if (/[A-Z]/.test(password)) {
        strength += 1;
    }

    // Lowercase check
    if (/[a-z]/.test(password)) {
        strength += 1;
    }

    // Number check
    if (/[0-9]/.test(password)) {
        strength += 1;
    }

    // Special character check
    if (/[^A-Za-z0-9]/.test(password)) {
        strength += 1;
    }

    return { strength };
}

// Form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const passwordInput = form.querySelector('input[name="password"]');
        const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');

        // Password strength bar only (no text messages)
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                showPasswordStrengthBar(this);
            });
        }
    });
});

function showPasswordStrengthBar(input) {
    const { strength } = checkPasswordStrength(input.value);
    const strengthIndicator = input.parentElement.querySelector('.password-strength') || createStrengthBar(input);
    
    if (input.value === '') {
        strengthIndicator.style.display = 'none';
        return;
    }

    strengthIndicator.style.display = 'block';
    updateStrengthBar(strengthIndicator, strength);
}

// UI helper functions - BAR ONLY
function createStrengthBar(input) {
    const indicator = document.createElement('div');
    indicator.className = 'password-strength';
    indicator.style.cssText = `
        margin-top: 5px;
        font-size: 0.8rem;
        display: none;
    `;
    input.parentElement.appendChild(indicator);
    return indicator;
}

function updateStrengthBar(indicator, strength) {
    const colors = ['#ff4444', '#ffbb33', '#ffeb3b', '#00C851', '#007E33'];
    
    indicator.innerHTML = `
        <div style="height: 4px; background: #eee; border-radius: 2px; margin-bottom: 5px;">
            <div style="width: ${(strength / 5) * 100}%; height: 100%; background: ${colors[strength - 1]}; border-radius: 2px; transition: all 0.3s ease;"></div>
        </div>
    `;
}
