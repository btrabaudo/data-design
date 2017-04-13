<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Conceptual Model</title>
    </head>
    <body>
        <header>
            <h1>Conceptual Model</h1>
        </header>

        <main>
            <ol>
                <li><strong>Entities</strong></li>
                    <ol>
                        <li>Profile</li>
                            <ul>
                                <li><strong>Attributes</strong></li>
                                    <ul>
                                        <li>profileId</li>
                                        <li>profileAtHandle</li>
                                        <li>profileEmail</li>
                                    </ul>
                            </ul>
                        <li>Product</li>
                            <ul>
                                <li><strong>Attributes</strong></li>
                                    <ul>
                                        <li>productId</li>
                                        <li>productContent</li>
                                        <li>productProfileId</li>

                                    </ul>
                            </ul>
                        <li>Favorite Product (Weak)</li>
                            <ul>
                                <li><strong>Attributes</strong></li>
                                    <ul>
                                        <li>favoriteProductId</li>
                                        <li>favoriteProfileId</li>
                                    </ul>

                            </ul>
                    </ol>
        </main>
    </body>
</html>