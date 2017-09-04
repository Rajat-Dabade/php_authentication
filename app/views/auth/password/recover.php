{% extends 'templates/default.php' %}

{% block title %}Recover password{% endblock %}

{% block content %}
	<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
		<p>Enter your email address to recover your password.</p>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
			{% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
		</div>
		<div>
			<input type="submit" value="Request reset">
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
{% endblock %}