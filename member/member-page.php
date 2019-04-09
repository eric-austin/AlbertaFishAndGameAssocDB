
<?php include "../templates/header.php"; ?>

<?php $MemNo = $_GET["MemNo"];?>
<body>
	<h1>Member Page</h1>

	<ul>
		<li>
		<?php echo '<a href="membership.php?MemNo=' . $MemNo . '"><strong>Membership Details</strong></a> - view membership details'?>
		</li>
		<li>
			<a href="club.php?MemNo=<?php echo $MemNo?>"><strong>Club Details</strong></a> - view your club details
		</li>
		<li>
			<a href="events.php?MemNo=<?php echo $MemNo?>"><strong>Events</strong></a> - search for club events
		</li>
		<li>
			<a href="firing-range.php?MemNo=<?php echo $MemNo?>"><strong>Firing Range</strong></a> - view firing ranges
		</li>
		<li>
			<a href="newsletters.php?MemNo=<?php echo $MemNo?>"><strong>Newsletters</strong></a> - view newsletter subscriptions
		</li>
	</ul>
</body>

<?php include "../templates/footer.php"; ?>
