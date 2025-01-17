<h2>Edit Post</h2>
<form method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>
    <label for="content">Content:</label><br>
    <textarea name="content" rows="4" cols="50" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>
    <input type="submit" value="Update Post">
</form>