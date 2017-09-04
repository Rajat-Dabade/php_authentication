{% extends 'email/templates/default.php' %}

{% block content %} 
	<p>You have requested to change the password</p>
	<p>Click this link to reset the password: {{ baseUrl }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
 {% endblock %}