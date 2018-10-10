<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                                        <a class="dropdown-item" href="#">
                                            Open All
                                        </a>
                                        <a class="dropdown-item" href="#">
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
                                :options="fetchExample0"
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
        </div>
    </div>
</template>

<script>
    import LiquorTree from 'liquor-tree'

    export default {
        name: 'assets-library',
        mounted() {
            const treeAPI = this.$refs.tree.tree;

            this.$refs.tree.$on('node:selected', node => {
                treeAPI.loadChildren(node)
            })
        },
        methods: {
            handleMountedTree: (tree) => {

            }
        },
        data: function () {
            return {
                fetchExample0: {
                    dnd: true,
                    fetchData(node) {
                        // return Promise object
                        return fetch(`/tree?id=${node.id}`)
                            .then(r => r.json())
                            .then(items => {
                                items.forEach(setData)

                                function setData(item) {
                                    item.data = item

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
    .tree-node.matched > .tree-content {
        background: #f7f2e7;
    }

    .fa-md {
        font-size: 1em !important;
    }
</style>