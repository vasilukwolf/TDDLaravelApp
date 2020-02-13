<template>
    <modal name="new-project" classes="p-10 rounded-lg bg-card" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's start some new</h1>

        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="text-sm block mb-2">Title</label>
                    <input type="text" id="title" class="border border-muted-light py-1 p-2 px-2 text-xs  w-full block rounded">
                </div>
                <div class="mb-4">
                    <label for="description" class="text-sm block mb-2">Description</label>
                    <textarea type="text" id="description" class="border border-muted-light py-1 px-2 text-xs  w-full block rounded" rows="5">
                    </textarea>
                </div>
            </div>
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label  class="text-sm block mb-2">Need some super challenge Task</label>
                    <input type="text"
                           class="border border-muted-light py-1 px-2 text-xs p-2 w-full block rounded"
                           placeholder="Change Task"
                           v-for="task in tasks"
                           v-model="tasks.value"
                    >
                </div>

                <button class="inline-flex items-center text-xs" @click="addTask">
                    <svg height="18" width="18" viewBox="0 0 512 512"  xmlns="http://www.w3.org/2000/svg">
                        <path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0"
                              fill="#2196f3"/><path d="m256 512c-141.164062 0-256-114.835938-256-256s114.835938-256 256-256 256
                               114.835938 256 256-114.835938 256-256 256zm0-480c-123.519531 0-224 100.480469-224 224s100.480469
                                224 224 224 224-100.480469 224-224-100.480469-224-224-224zm0 0"/>
                        <path d="m368 272h-224c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h224c8.832031
                         0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/>
                        <path d="m256 384c-8.832031 0-16-7.167969-16-16v-224c0-8.832031 7.167969-16 16-16s16
                         7.167969 16 16v224c0 8.832031-7.167969 16-16 16zm0 0"/></svg>
                    <span class="m-1">Add new task field</span>
                </button>
            </div>
        </div>
        <footer class="flex justify-end">
            <button class="is-outlined button mr-4 " @click="$modal.hide('new-project')">Cancel</button>
            <button class="button">Create project</button>
        </footer>
    </modal>
</template>
<script>
    export default {
        data() {
            return {
                tasks:[
                    {value: ''}
                    ]
                };
            },
        methods:{
            addTask(){
                this.tasks.push({value:''})
            }
        }
    }
</script>
