<template>
  <v-container fill-height class="test_red">
    <v-row class="fill-height test_blue" justify="center" align="center">
      <v-col cols="12" md="6" class="test_yellow">
        <v-img
          :src="imgError"
          style="image-rendering: optimizeSpeed"
          cover
          position="center"
        >
          <template v-slot:placeholder>
            <v-row class="fill-height ma-0" align="center" justify="center">
              <v-progress-circular indeterminate color="primary" />
            </v-row>
          </template>
        </v-img>
      </v-col>
      <v-col cols="12" md="6" class="test_yellow">
        <v-card elevation="10" class="py-5" rounded="xl">
          <v-container>
            <v-card-title
              class="title d-flex justify-center"
              v-text="'OOPS!'"
            />
            <v-card-text class="py-5">
              <v-container>
                <v-row justify="center">
                  <v-col cols="12" md="10">
                    <p
                      class="title_description"
                      v-text="$t('errors.cart_not_found')"
                    />
                    <span
                      class="description"
                      v-text="$t('errors.page_message_description')"
                    />
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions class="pt-5">
              <v-row justify="center">
                <v-col cols="12" md="10" lg="6" class="test_green">
                  <v-row justify="space-around">
                    <v-tooltip bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          v-if="redirectBack"
                          fab
                          v-bind="attrs"
                          color="primary"
                          v-on="on"
                          @click="$router.go(-2)"
                        >
                          <v-icon v-text="'mdi-keyboard-return'" />
                        </v-btn>
                      </template>
                      <span v-text="$t('general.go_back')" />
                    </v-tooltip>
                    <v-tooltip bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          fab
                          v-bind="attrs"
                          color="primary"
                          v-on="on"
                          @click="$router.push({ name: 'Home' })"
                        >
                          <v-icon v-text="'mdi-home'" />
                        </v-btn>
                      </template>
                      <span v-text="$t('general.go_to_homepage')" />
                    </v-tooltip>
                  </v-row>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "CartNotFound",
  data: () => ({
    redirectBack: false,
    imgError: require("@/assets/img/error/error.jpg"),
  }),
  mounted() {
    this.redirectBack = window.history.length > 3 ? true : false;
  },
};
</script>

<style lang="scss" scoped>
.title {
  font-size: 5rem !important;
  font-weight: 800;
  color: var(--v-primary-base);
}
.title_description {
  font-size: 1.8rem !important;
  font-weight: 800;
  line-height: 2rem;
}
.description {
  font-size: 1.2rem !important;
}
</style>
