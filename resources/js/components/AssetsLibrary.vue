<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <i class="far fa-folder"></i>
                                Digital Assets
                            </span>
                            <div class="d-flex">
                                <input type="text" class="form-control form-control-sm mr-3" v-model="query">
                                <div class="dropdown">
                                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#" @click.prevent="OpenAllNodes">
                                            Open All
                                        </a>
                                        <a class="dropdown-item" href="#" @click.prevent="collapseAllNodes">
                                            Collapse All
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Refresh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- load the tree here -->
                        <liquor-tree
                            ref="tree"
                            @tree:mounted="handleMountedTree"
                            @node:dblclick="handleStartEditingNode"
                            @node:editing:stop="handleStopEditingNode"
                            :options="treeOptions"
                            :filter="query"
                        >
                            <div class="tree-scope" slot-scope="{ node }">
                                <template v-if="!node.hasChildren()">
                                    <i :class="node.data.icon" class="fa-md"></i>
                                    {{ node.text }}
                                </template>

                                <template v-else>
                                    <i :class="[node.expanded() ? 'far fa-folder-open' : 'far fa-folder']"
                                       class="fa-md"></i>
                                    {{ node.text }}
                                </template>
                            </div>
                        </liquor-tree>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                uploader
            </div>
        </div>
    </div>
</template>

<script>
    import LiquorTree from 'liquor-tree'

    export default {
        name: 'assets-library',
        mounted() {
            const treeAPI = this.$refs.tree.tree;

            this.$refs.tree.$on('node:expand', node => {
                let rootNode = this.$refs.tree.getRootNode()
                if (rootNode.id != node.id) {

                    treeAPI.loadChildren(node)
                }
            });

        },
        methods: {
            OpenAllNodes: () => {
                console.log(this.$refs)
                this.$refs.tree.tree.expandAll()
            },
            collapseAllNodes: () => {
                this.$refs.tree.tree.collapseAll()
            },
            handleStartEditingNode: (node) => {

                node.startEditing()

            },
            handleStopEditingNode: (node, isTextChanged) => {

                if (isTextChanged) {
                    // call api to rename node
                }

            },
            handleMountedTree: (tree) => {
                let rootNode = tree.getRootNode()
                let firstChildNode = tree.find(n => n.id === rootNode.children[0].id)[0]

                rootNode.expand()

                window.setTimeout(_ => {
                    firstChildNode.expand()
                }, 500)
            }
        },
        data: function () {
            return {
                treeOptions: {
                    minFetchDelay: 500,
                    dnd: true,
                    filter: function (query) {
                        return false
                    },
                    fetchData(node) {
                        // return Promise object
                        return fetch(`/tree?id=${node.id}`)
                            .then(r => r.json())
                            .then(items => {
                                items.forEach(setData)

                                function setData(item) {
                                    item.data = item
                                    item.isBatch = item.data.is_batch

                                    if (item.children) {
                                        item.children.forEach(setData)
                                    }
                                }

                                return items
                            }).catch(e => console.log(e))
                    }
                },
                query: ''
            }
        },
        components: {
            LiquorTree
        }
    }
</script>

<style>
    .tree-children {
        transition: unset;
    }

    .tree-node.matched > .tree-content {
        background: #f7f2e7;
    }

    .fa-md {
        font-size: 1em !important;
    }
</style>