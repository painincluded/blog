<h2>Blog Posts</h2>
<a href="/blog/create">Create a New Post</a><br><br>

<?php if ($posts): ?>
    <?php foreach ($posts as $post): ?>
        <div>
            <h3><a href="/blog/view?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <a href="/blog/edit?id=<?php echo $post['id']; ?>">Edit</a> |
            <a href="/blog/delete?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        </div><br>
    <?php endforeach; ?>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>