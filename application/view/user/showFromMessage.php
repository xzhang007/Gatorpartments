<div class="container">
    <h2>You are in the View: application/view/users/showFromMessage.php (everything in this box comes from that file)</h2>
    
        <h3>List of messages</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>From</td>
                <td>Content</td>
		<td>listingId</td>
                
            </tr>
            </thead>
            <tbody>
        
            <?php foreach ($messages as $message) { ?>
        
                <tr>
                   <td><?php if (isset($message->username)) echo htmlspecialchars($message->username, ENT_QUOTES, 'UTF-8'); ?></td>
                   <td><?php if (isset($message->content)) echo htmlspecialchars($message->content, ENT_QUOTES, 'UTF-8'); ?></td>
                   <td><?php if (isset($message->listingId)) echo htmlspecialchars($message->listingId, ENT_QUOTES, 'UTF-8'); ?></td>
                
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

