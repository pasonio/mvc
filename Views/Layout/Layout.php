<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="utf-8">
		<title>Test MVC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <!--  Have to add here because of hosting bult in ads script-->
        <style>
            .form {
                width:600px;
                margin: auto;
                background: gray;
            }
            .ui-dialog{
                background-color: gray;
                padding: 10px;
            }

            .ui-dialog .ui-dialog-titlebar{
                border-bottom: 1px solid black;
            }

            .ui-dialog-titlebar-close {
                float: right;
                text-align: center;
            }

            .ui-dialog .ui-dialog-buttonset {
                border-top: 1px solid black;
                text-align: center;
            }
            .ui-dialog .ui-dialog-buttonset button{
                margin: 10px;
            }
        </style>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a id="about_button" href="/home/login">Log In</a></li>
                    </ul>
                </div>
			</nav>
		</header>
		<div class="main">
			<?= $body ?>
		</div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!--  Have to add here because of hosting bult in ads script-->
        <script type="text/javascript">
            $(document).ready( function() {
                $('#submit_form').on('click', function(e) {
                    e.preventDefault();
                    preview();
                });

                function preview() {
                    var user_input = $('input[name="Task[username]"]').val();
                    var user_label = $('label[for="username"]').text();
                    var user_data = '<p><strong>' + user_label + '</strong> : ' + user_input + '</p>';

                    var email_input = $('input[name="Task[email]"]').val();
                    var email_label = $('label[for="email"]').text();
                    var email_data = '<p><strong>' + email_label + '</strong> : ' + email_input + '</p>';

                    var textarea = $('textarea[name="Task[task_description]"]').val();
                    var textarea_label = $('label[for="task_description"]').text();
                    var textarea_data = '<p><strong>' + textarea_label + '</strong> : ' + textarea + '</p>';

                    var data = user_data + email_data + textarea_data;
                    $('#preview_data').html('');
                    $('#preview_data').append(data);
                    $('#preview_data').dialog({
                        resizable: false,
                        modal: true,
                        buttons: {
                            'Submit': function () {
                                $('#add_task').submit();
                            },
                            Cancel: function () {
                                $(this).dialog("close");
                            }
                        }
                    });
                }
            });
        </script>
    </body>
</html>