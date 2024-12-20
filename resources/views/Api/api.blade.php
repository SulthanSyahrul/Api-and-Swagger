<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui.min.css">
</head>

<body>
    <div id="swagger-ui"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-bundle.min.js"></script>
    <script>
        window.onload = () => {
            window.ui = SwaggerUIBundle({
                url: "/swagger.yaml", // Pastikan path ini benar
                dom_id: '#swagger-ui',
            });
        };
    </script>
</body>

</html>