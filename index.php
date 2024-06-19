<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Webseiten-Screenshot-Tool</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1>Webseiten-Screenshot-Tool</h1>
    <form action="generate.php" method="post">
      <div class="form-group">
        <label for="urls">URLs (eine pro Zeile):</label>
        <textarea class="form-control" id="urls" name="urls" rows="5" required></textarea>
      </div>
      <div class="form-group">
        <label for="resolution">Auflösung wählen:</label>
        <select class="form-control" id="resolution" name="resolution">
          <option value="1024x768">1024x768</option>
          <option value="1280x720">1280x720</option>
          <option value="1366x768">1366x768</option>
          <option value="1440x900">1440x900</option>
          <option value="1600x900">1600x900</option>
          <option value="1920x1080">1920x1080</option>
          <option value="2560x1440">2560x1440</option>
          <option value="3840x2160">3840x2160 (4K)</option>
          <option value="custom">Andere (Pixelgenau)</option>
        </select>
      </div>
      <div class="form-group" id="customResolution" style="display: none;">
        <label for="customWidth">Breite:</label>
        <input type="number" class="form-control" id="customWidth" name="customWidth" placeholder="Breite in Pixeln">
        <label for="customHeight">Höhe:</label>
        <input type="number" class="form-control" id="customHeight" name="customHeight" placeholder="Höhe in Pixeln">
      </div>
      <div class="form-group">
        <label for="format">Dateiformat wählen:</label>
        <select class="form-control" id="format" name="format">
          <option value="png">PNG</option>
          <option value="jpg">JPG</option>
        </select>
      </div>
      <div class="form-group" id="outputDimensions">
        <label for="outputWidth">Ausgabebreite:</label>
        <input type="number" class="form-control" id="outputWidth" name="outputWidth" placeholder="Breite in Pixeln">
        <label for="outputHeight">Ausgabehöhe:</label>
        <input type="number" class="form-control" id="outputHeight" name="outputHeight" placeholder="Höhe in Pixeln">
      </div>
      <button type="submit" class="btn btn-primary">Screenshots erstellen</button>
    </form>
  </div>

  <!-- Bootstrap JS (optional for some components) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    // Show/hide custom resolution inputs based on selection
    document.getElementById('resolution').addEventListener('change', function() {
      var customResolution = document.getElementById('customResolution');
      if (this.value === 'custom') {
        customResolution.style.display = 'block';
      } else {
        customResolution.style.display = 'none';
      }
    });
  </script>
</body>
</html>
