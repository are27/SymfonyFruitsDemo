<template>
    <div>
        <div class="ui-header">
            <div class="favs">
                <a class="fancy-button" href="../">Back to List</a>
            </div>
        </div>
        <div class="fruit-list">
            <table class="tableData" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Carbohydrates</th>
                        <th>Protein</th>
                        <th>Fat</th>
                        <th>Calories</th>
                        <th>Sugar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in fruits" :key="index">
                        <td>{{ item.name }}</td>
                        <td>{{ item.carbohydrates }}</td>
                        <td>{{ item.protein }}</td>
                        <td>{{ item.fat }}</td>
                        <td>{{ item.calories }}</td>
                        <td>{{ item.sugar }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import { reactive, onMounted } from "vue";

export default {
    name: "Faves",
    setup() {
        const state = reactive({
            fruits: [],
        });

        onMounted(() => {
            const el = document.querySelector("div[data-fruits]");
            const myfruits = JSON.parse(el.dataset.fruits);
            state.fruits.push(...myfruits);
        });

        return {
            ...state,
        };
    },
};
</script>
