<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <form id="latexForm">
        <textarea name="latex" id="latexInput"></textarea>
        <button type="submit">Generate PDF</button>
    </form>

    <script>
        $('#latexForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/generate-pdf',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle PDF response, e.g., display in iframe
                    alert()

                    // var blob = new Blob([response], {
                    //     type: 'application/pdf'
                    // });
                    // var url = URL.createObjectURL(blob);
                    // $('#pdfViewer').attr('src', url);
                }
            });
        });
    </script>

    <iframe id="pdfViewer" style="width: 50%; height: 300px;"></iframe>

</body>

</html>