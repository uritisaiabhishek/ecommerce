<?php
    require('connection.inc.php');
    require('functions.inc.php');
?>
<form action="stripe_submit.php" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="1000"
		data-name="Programming with Vishal"
		data-description="Programming with Vishal Desc"
		data-image="https://chronopegasus.com/ecommerce/assets/images/favicon.png"
		data-currency="inr"
		data-email="user@gmail.com"
	>
	</script>
</form>