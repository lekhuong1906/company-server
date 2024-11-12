<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nested set Model</title>
    <link href="https://unpkg.com/vis-network@9.0.4/styles/vis-network.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/vis-network@9.0.4/dist/vis-network.min.js"></script>

</head>

<body>
    <div id="mynetwork" style="width: 100%; height: 600px; border: 1px solid lightgray;"></div>
    <script>
        //const maxNodes = 100; // Limit the number of nodes
        const nodes = new vis.DataSet([
            @foreach ($data as $index => $employee)

                {
                    id: {{ $employee->id }},
                    label: "{{ $employee->position }}: {{ $employee->name }}"
                },
            @endforeach
        ]);

        const edges = new vis.DataSet([
            @foreach ($data as $employee)
                @foreach ($employee->childrenRecursive as $child)
                    {
                        from: {{ $employee->id }},
                        to: {{ $child->id }}
                    },
                @endforeach
            @endforeach
        ]);

        const container = document.getElementById('mynetwork');
        const data = {
            nodes: nodes,
            edges: edges
        };
        const options = {
            layout: {
                hierarchical: {
                    direction: 'UD',
                    sortMethod: 'directed'
                }
            }
        };
        new vis.Network(container, data, options);
    </script>


</body>

</html>
