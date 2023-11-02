@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')


<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class="row" style="display: grid;">
            <div class="col-md-12">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">{{ isset($flow->title) ? $flow->title : 'Flow' }}</h4>
                </span>
            </div>
        </div>
    </div>


    <div class="panel-body panel-body-with-table">
        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
            <div class="form-label w-full xl:!mr-10">
                <div class="panel-body">
                     <!-- BEGIN: Large Modal Content -->
                        <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body p-10 text-center" id="content_loader">

                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="container">

                        <div id="treemain">
                            @php
                                $i = 0;
                            @endphp
                            @foreach($messages as $message)
                                <div id="node_{{ $i }}" class="window hidden"
                                     data-id="{{ $i }}"
                                     data-parent={{ ($message->node_parent == 0)?"0":"0" }}
                                     data-first-child={{ ($message->node_parent == 0)?"1":"0" }}
                                     data-next-sibling=""

                                     >
                                    {!! $message->message !!}
                                    <div style='clear:both; width:100%'></div>
                                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-primary mr-1 mb-2 mt-5" onClick="myitem({{ $message->id }}, {{ $flow->id }})">
                                        Editar Mensaje
                                    </a>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/1.7.10/jsPlumb.min.js" integrity="sha512-A1gTsaWUck7mkEu6D8/938PKlkVS79TkgqAloQbGU4bhOPUBS9JVknN5x++J3eRNO8g6D/T3kqhHBd4KkqRNxg==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../dist/js/jsplumb-tree.js"></script>

    <script type="text/javascript">
        // -- init -- //
        jsPlumb.ready(function() {

            // connection lines style
            var connectorPaintStyle = {
                lineWidth:3,
                strokeStyle:"#4F81BE",
                joinstyle:"round"
            };

            var pdef = {
                // disable dragging
                DragOptions: null,
                // the tree container
                Container : "treemain"
            };
            var plumb = jsPlumb.getInstance(pdef);

            // all sizes are in pixels
            var opts = {
                prefix: 'node_',
                // left margin of the root node
                baseLeft: 24,
                // top margin of the root node
                baseTop: 24,
                // node width
                nodeWidth: 100,
                // horizontal margin between nodes
                hSpace: 36,
                // vertical margin between nodes
                vSpace: 10,
                imgPlus: '../../dist/images/tree_expand.png',
                imgMinus: '../../dist/images/tree_collapse.png',
                // queste non sono tutte in pixel
                sourceAnchor: [ 1, 0.5, 1, 0, 10, 0 ],
                targetAnchor: "LeftMiddle",
                sourceEndpoint: {
                    endpoint:["Image", {url: "../../dist/images/tree_collapse.png"}],
                    cssClass:"collapser",
                    isSource:true,
                    connector:[ "Flowchart", { stub:[40, 60], gap:[10, 0], cornerRadius:5, alwaysRespectStubs:false } ],
                    connectorStyle:connectorPaintStyle,
                    enabled: false,
                    maxConnections:-1,
                    dragOptions:null
                },
                targetEndpoint: {
                    endpoint:"Blank",
                    maxConnections:-1,
                    dropOptions:null,
                    enabled: false,
                    isTarget:true
                },
                connectFunc: function(tree, node) {
                    var cid = node.data('id');
                    console.log('Connecting node ' + cid);
                }
            };
            var tree = jQuery.jsPlumbTree(plumb, opts);
            tree.init();
            window.treemain = tree;
        });

        function positioningBlockBug() {
            var oldNode = window.treemain.nodeById(2);
            //var newNode = $('#node_2_new');
            var newNode = $('    <div id="node_2" class="window hidden"\n' +
                '         data-id="2"\n' +
                '         data-parent="0"\n' +
                '         data-first-child="6"\n' +
                '         data-next-sibling="3">\n' +
                '        Node 2 NEW\n' +
                '    </div>\n');
            if (oldNode) {
                // butta il nodo nel container
                oldNode.replaceWith(newNode);
                // rimostra il nodo
                newNode.id = 'node_2';
                newNode.show();
                // aggiorna l'albero
                window.treemain.update();
            }

        }

        function myitem(el, flow){

            $("#content_loader").html("Cargando...");
            event.preventDefault();
            //Hacemos la peticion
            var value = el;
            var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
            var data={flow:flow,_token:token,value:value};

            var url = "{{route('flow_messages.flow_messages.edit')}}";
            $.ajax({
                type:'POST',
                url: url,
                data: data,
                success: function(respuesta){
                    $('#content_loader').html(respuesta);
                },
                error: function (){
                    console.log('Error');
                }
            })

        }
    </script>

        <style type="text/css">
        .window {
            font-weight: bold;
            cursor: pointer;
            border:1px solid #346789;
            box-shadow: 2px 2px 10px #aaa;
            -o-box-shadow: 2px 2px 10px #aaa;
            -webkit-box-shadow: 2px 2px 10px #aaa;
            -moz-box-shadow: 2px 2px 10px #aaa;
            -moz-border-radius:0.5em;
            border-radius:0.5em;
            /*
            opacity:0.8;
            filter:alpha(opacity=80);
            */
            width: 25em; height: auto;
            font-size: 10px;
            padding: 10px;
            text-align:left;
            z-index:20; position:absolute;
            background-color:#eeeeef;
            color:black;
            font-family:helvetica;
            word-wrap:break-word;
        }

        .window:hover {
            box-shadow: 2px 2px 10px #444;
            -o-box-shadow: 2px 2px 10px #444;
            -webkit-box-shadow: 2px 2px 10px #444;
            -moz-box-shadow: 2px 2px 10px #444;
            /*
            opacity:0.6;
            filter:alpha(opacity=60);
            */
        }

        /*
        .window > div {
            margin-top: 19%;
            margin-bottom: 19%;
        }
        */

        .hidden {
            display: none;
        }

        .collapser {
            cursor: pointer;
            border:1px dotted gray;
            z-index:21;
        }

        .errorWindow {
            border: 2px solid red;
        }

        #treemain {
            height: 500px;
            width: 100%;
            position: relative;
            overflow: auto;
        }

    </style>

@endsection
