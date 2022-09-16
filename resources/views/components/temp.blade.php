                <template x-if="content.type=='text-area'">
                        <input placeholder="name" x-model="content.name" type="text" class="input" >
                        <textarea x-model="content.label" type="text">
                            label
                        </textarea>
                </template>