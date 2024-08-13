<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One To Many</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <table>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->profile->website_url }}</td>
            <td>
                <ol>
                    @foreach ( $user->posts as $post)
                    <li>{{ $post->title }}
                        <br>
                        {{ $post->body }}
                        <hr>
                        <ul>
                            @foreach ($post->tags as $tag)
                            <li>{{ $tag->name }}
                                <br>
                                {{ $tag->subTag->name }}
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ol>
            </td>
        <tr>
            @endforeach
    </table>
</body>

</html>