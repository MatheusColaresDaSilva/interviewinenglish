<?php
$plan = $_GET['plan'] ?? null;

if (!$plan || !in_array($plan, ['basic', 'standard', 'executive'])) {
    http_response_code(403);
    die("Acesso não autorizado");
}
?>
<form id="postToSuccess" action="checkout-success.php" method="POST">
  <input type="hidden" name="plan" value="<?= htmlspecialchars($plan) ?>">
</form>
<script>
  document.getElementById('postToSuccess').submit();
</script>
