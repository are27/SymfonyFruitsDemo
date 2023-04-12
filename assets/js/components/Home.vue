<template>
    <div>
        <div class="ui-header">
            <div class="search">
                <label for="search-input">Filter:</label>
                <input
                    type="text"
                    id="search-input"
                    v-model="searchTerm"
                    placeholder="by Name or Family"
                />
            </div>
            <div class="favs">
                <form method="post" action="favourites">
                    <input
                        type="text"
                        class="hidden"
                        name="faveList"
                        id="faveList"
                        ref="favRef"
                    />
                    <input
                        class="fancy-button"
                        type="submit"
                        value="See Favourites"
                        v-if="isSubmitVisible"
                    />
                </form>
            </div>
        </div>
    </div>
    <div class="fruit-list">
        <table class="tableData" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Family</th>
                    <th>Genus</th>
                    <th width="6%">Favourite</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in paginatedItems" :key="index">
                    <td>{{ item.name }}</td>
                    <td>{{ item.family }}</td>
                    <td>{{ item.genus }}</td>
                    <td>
                        <input
                            type="checkbox"
                            class="favChooser"
                            :id="'fave' + item.id"
                            :name="'fave' + item.id"
                            :value="item.id"
                            v-on:click="handleCheckboxClick(item)"
                            v-model="selectedItems"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button
                class="fancy-button"
                :disabled="currentPage === 1"
                @click="currentPage--"
            >
                Prev
            </button>
            <button
                class="fancy-button"
                v-for="page in totalPages"
                :key="page"
                :class="{ active: page === currentPage }"
                @click="currentPage = page"
            >
                {{ page }}
            </button>
            <button
                class="fancy-button"
                :disabled="currentPage === totalPages"
                @click="currentPage++"
            >
                Next
            </button>
        </div>
    </div>
</template>

<script>
import { ref, computed, reactive, onMounted, watch } from "vue";

export default {
    name: "App",
    setup() {
        const state = reactive({
            fruits: [],
            selectedItems: [],
            isActive: false,
            favArray: [],
        });

        const items = ref(state.fruits);
        const currentPage = ref(1);
        const faveList = ref("");
        const itemsPerPage = 18;
        const searchTerm = ref("");
        const isSubmitVisible = computed(() => state.isActive);

        const filteredItems = computed(() => {
            if (!searchTerm.value) {
                return items.value;
            }

            return items.value.filter((item) => {
                const lowerCasedTerm = searchTerm.value.toLowerCase();
                return (
                    item.name.toLowerCase().includes(lowerCasedTerm) ||
                    item.family.toLowerCase().includes(lowerCasedTerm)
                );
            });
        });

        const totalPages = computed(() =>
            Math.ceil(filteredItems.value.length / itemsPerPage)
        );

        const paginatedItems = computed(() => {
            const startIndex = (currentPage.value - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            return filteredItems.value.slice(startIndex, endIndex);
        });

        watch(jsonArray, (newValue) => {
            faveList.value = newValue;
        });

        const jsonArray = computed(() => {
            return JSON.stringify(state.selectedItems);
        });

        const handleCheckboxClick = (item) => {
            if (event.target.checked == true) {
                if (state.selectedItems.length < 10) {
                    state.selectedItems.push(item.id);
                } else {
                    event.target.checked = false;
                }
            } else {
                const index = state.selectedItems.indexOf(item.id);
                if (index > -1) {
                    state.selectedItems.splice(index, 1);
                }
            }
            const faveListInput = document.getElementById("faveList");
            faveListInput.value = JSON.stringify(state.selectedItems);
            if (state.selectedItems.length == 0) {
                faveListInput.value = "";
                state.isActive = false;
            } else {
                state.isActive = true;
            }
        };

        onMounted(() => {
            const el = document.querySelector("div[data-fruits]");
            const myfruits = JSON.parse(el.dataset.fruits);
            state.fruits.push(...myfruits);
        });

        return {
            currentPage,
            totalPages,
            paginatedItems,
            searchTerm,
            handleCheckboxClick,
            faveList,
            isSubmitVisible,
            ...state,
        };
    },
};
</script>
