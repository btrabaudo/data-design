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

                                <li>profileId</li>
                                <li>profileAtHandle</li>
                                <li>profileEmail</li>

                            </ul>
                        <li>Product</li>
                            <ul>

                                <li>productId</li>
                                <li>productContent</li>
                                <li>productProfileId</li>

                            </ul>
                        <li>Favorite Product (Weak)</li>
                            <ul>

                                <li>favoriteProductId</li>
                                <li>favoriteProfileId</li>

                            </ul>
                    </ol>
        </main>
    </body>
</html>