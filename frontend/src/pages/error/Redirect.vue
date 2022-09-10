<script>
export default {
  props: {
    url: {
      type: String,
      required: true,
    },
  },

  mounted() {
    const self = this;
    self.$store.dispatch("guest/removeInfo");
    self.$store.dispatch("delivery/removeDeliveryDetails");
    self.$store.dispatch("delivery/removeDeliveryMethod");
    self.$store.dispatch("guest/removeAddress");
    self.$store.dispatch("guest/removeSessionId");
    self.$store.dispatch("checkout/setTotal", 0);
    self.$store.dispatch("cart/deleteDetails");
    /* self.$store.dispatch("checkout/loadDeliveryServices"); */
    self.$store.dispatch("customer/removeOption");
    self.$store.dispatch("delivery/setOptionDoor", false);
    window.location.href = this.url;
  },
  render: function (h) {
    return h(); // avoid warning message
  },
};
</script>
