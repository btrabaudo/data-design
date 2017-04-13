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

                                <li>profileId (Primary)</li>
                                <li>profileAtHandle</li>
                                <li>profileEmail</li>
                                <li>profileValidationToken</li>
                                <li>profilePass (Primary)</li>
                                <li>profilePassHash</li>
                                <li>profilePassSalt</li>

                            </ul>
                        <li>Product</li>
                            <ul>

                                <li>productId (Primary)</li>
                                <li>productContent</li>
                                <li>productPrice</li>
                                <li>productDate</li>

                            </ul>
                        <li>Favorites Product (Weak)</li>
                            <ul>

                                <li>favoriteProductId (Composite)</li>
                                <li>favoriteProfileId (Composite)</li>
                                <li>favoriteDate</li>

                            </ul>
                    </ol>
        </main>
    </body>
</html>