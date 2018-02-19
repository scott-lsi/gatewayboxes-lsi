<!doctype html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Personaliser</title>
		
		<style>
			body, html {
				padding: 0; margin: 0; width: 100%; height: 100%;
			}
			
			#personaliser, iframe {
				width: 100%; height: 100%; border: 0;
			}
		</style>
	</head>
	
	<body>
		<div id="personaliser">
			<iframe src="{{ $iframeUrl }}"></iframe>
		</div>
        
        <script src="{{ asset('js/app.js') }}"></script>
	</body>
</html>