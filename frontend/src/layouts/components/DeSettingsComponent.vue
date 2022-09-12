<template>
  <div>
    <v-toolbar elevation="0">
      <v-toolbar-title>
        <h3>Settings <v-icon v-text="'mdi-cogs'" /></h3>
      </v-toolbar-title>
    </v-toolbar>
    <v-divider />
    <v-col cols="12">
      <p><b>Theme</b></p>
      <v-item-group v-model="value" mandatory>
        <v-row justify="space-around">
          <v-col
            v-for="(item, index) in options.theme"
            :key="index"
            cols="6"
            sm="6"
          >
            <v-item v-slot="{ active, toggle }">
              <v-btn
                block
                :color="active ? 'primary' : 'grey'"
                height="55"
                dark
                @click="toggle"
              >
                {{ item.name }}
                <v-icon right size="20" class="ml-2" v-text="item.icon" />
              </v-btn>
            </v-item>
          </v-col>
        </v-row>
      </v-item-group>
    </v-col>

    <v-divider />
    <v-col cols="12">
      <p><b>Tags View</b></p>
      <v-item-group v-model="tagsView" mandatory>
        <v-row justify="space-around">
          <v-col
            v-for="(item, index) in options.tags"
            :key="index"
            cols="6"
            sm="6"
          >
            <v-item v-slot="{ active, toggle }">
              <v-btn
                block
                :color="active ? 'primary' : 'grey'"
                height="55"
                value="item.value"
                dark
                @click="toggle"
              >
                {{ item.name }}
                <v-icon right size="20" class="ml-2" v-text="item.icon" />
              </v-btn>
            </v-item>
          </v-col>
        </v-row>
      </v-item-group>
    </v-col>
  </div>
</template>

<script>
export default {
  name: "SettingsComponent",
  data: () => ({
    alignment: 1,
    options: {
      theme: [
        { name: "Light", icon: "mdi-white-balance-sunny" },
        { name: "Dark", icon: "mdi-weather-night" },
      ],
      tags: [
        { name: "Active", icon: "mdi-eye", value: 1 },
        { name: "Inactive", icon: "mdi-eye-off", value: 0 },
      ],
    },
  }),
  computed: {
    tagsView: {
      get() {
        return this.$store.getters.tagsViewShow;
      },
      set(val) {
        this.$store.dispatch("settings/changeSetting", {
          key: "tagsView",
          value: val,
        });
      },
    },
    value: {
      get() {
        return this.$store.getters.darkTheme;
      },
      set(val) {
        this.$vuetify.theme.dark = val;
        this.$store.dispatch("settings/changeSetting", {
          key: "darkTheme",
          value: val,
        });
      },
    },
  },
  mounted() {
    this.$vuetify.theme.dark = this.$store.getters.darkTheme;
  },
};
</script>
