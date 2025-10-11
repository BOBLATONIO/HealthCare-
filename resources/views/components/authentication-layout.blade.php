<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Care +</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="{{ asset ('assets/js/tailwind.config.js') }}"></script>
</head>

<body>
    <section class="bg-blue-800 ">
        {{ $slot }}
    </section>

    <script>
    setTimeout(() => {
        const alertBox = document.getElementById('alertMessage');
        if (alertBox) {
            alertBox.style.opacity = '0';
            setTimeout(() => alertBox.remove(), 500); // Remove after fade-out
        }
    }, 6000); // 6 seconds
</script>

</body>



</html>