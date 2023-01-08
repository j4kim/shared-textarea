<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.classless.min.css">
    <script src="https://cdn.jsdelivr.net/npm/gun/gun.js"></script>
    <title>Shared Textarea</title>
  </head>
  <body>
    <main>
      <h1 style="text-align:center">Shared Textarea</h1>
      <textarea rows="10" id="textarea"></textarea>
    </main>
    <script>
      const gun = Gun(["https://gun-manhattan.herokuapp.com/gun"]);

      const content = gun.get("shared-textarea").get("content")

      textarea.oninput = () => content.put(textarea.value)

      content.on((data) => textarea.value = data)
    </script>
  </body>
</html>