<template>

  <div class="container">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASsAAACoCAMAAACPKThEAAAAwFBMVEUAAAAdm/Adm+8cm/IemvIdnfMem+0fofkJAAAZne8fm+sdnfkdNEEemvUfmu4dn/cdVHgVLj4UN1AcWIMdaZ0gfbwdcaYdW4AZQFYJCQMICgsnebATKDQbS28mluASM0gtZo0YIywiic8eOEkiSWUOICwni8sVFhQVQmEdQlwgf7oubJQhY5IjjdQ0pvUuf7IYaaEwicMPFyMQGBsjRV0ikNcac68kUmwCDBQ5o+kcm/waMksUHCIrc6IkebkeT3HXmzN/AAAET0lEQVR4nO3ba1PbOBQG4OhyJEtaW7lSINQQF8JlE9pdSpd2ufz/f7VOmkDSRiYws1Emfh+GD8H2zOHMkXQsO40GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMDWSdqdbq+392H/IHYk2+6wK7Qncs5r0z9aPPJHrJC2VNJVjnHOhFJMMGP2kvmRj/l+zMA27Pjk1VMGhWYvKHMu/zT9+0mui/87vm3S18evnHGkHF/IFbNKiOvTs86QnDSvXbxTlKdPlSecW0rFQqpkyg0nIu+Zct0NRbkVLlwmTGWyei6Ti2WluGBKlb9WuMdNhbkVur6cgVRFsk4X56olmRtO5vjLo/DFu+WKyv86NZfBE3IKpErQn41Ge5T1NhhtXONproTfCxwPl5W8/lwIrfMkcOXuGU9LJFV6eLPyeD9UVkxIEsLkqy/bScV8ifPfV45Da0K5YlIyYerUin7x8+Ut1X/9/dvhGy1EIFVCCXdb3W7smM58PpJcSfPw6+Sz72QgVYxbV5xHiTmWliEx7conXRPzanS4dPhiuWVf4q8ixRzN2GeLo8yrq8Up6DKcK+470YKOpOOsWMwHFy4fPd/ltZwN11XtcpX80myKNCWveW90MZ27KtbB+uWq8bVc6srCeq4tKbgQarKtZ4rebXi6qmOuGp+dVGLlckcU7ETLAtTt2JFH0NcsC+ck6NWNr11zNSpvUh44VYy1EKrNBsPMrfPFt+a1VG9PFo8d+6Y9ejbZ4XwHGseOfdNG78rThP8WO/ZNO6tY6V7JVTN27Bs3fm+yarcMNhr/aGZC2y5BovyxsSOPYOjevgZyzqk+++wvzhkL3/OFKEWnsQOP4at+c125TPD6PJNY9KRTzlVp7Vxx7mrXMczs566cr8X6yRKW6vRQYknSzTwPbDasIuk2dsgRHXQKIdfuHbj+GDvgWNp3d3dnzet0rbriVkqqY3P100hrRy5dr6YsSWXqd38zl5RroCh78bXGIPfW5bEjjqijy+6Sr3lnKKwOv1ZTA7e+rKr1Nkc593W8vXlxY2U5AtfKlSJTz5b92UC5LPzYdGkI6tq2oXP3Q2/X6tvdQ+xQt8AH+8MLYZjgwT5LKkbD2HFuheRkaLyWk6280FzFyeL7ODODdvO7k+H9rB9VryzXzlOehltSaZGqZ4Oenr62tmr8yYzsv7ED3BrJSLtgTTHrxvgC3Ewyso6Fe6xMF5jWpw4ue9rT5E33QKqEHsWOMaqf79Emx+1Rz2jPJ2n6fW+UGFdKuLwVOdjYmtaUiSjzRBXbMTJNtap3UU3d7xld0SNMGEPUH8QOdCsMHrLKqiLN+3V7KS0suSiU99NNUSHme6OcTz6RM0UTq9+Sw+ajNZSSKuf2Wb7IE/HHDgbfKkdPX3q5El5r7WU27nWbR6ioavetVussdhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAdfIfp5k1mSE7fEMAAAAASUVORK5CYII=">
  </div>

  <div>
    <div>
      <h1 class="welcome">Welcome</h1>
    </div>
    <div>
      <h2 class="join_today">Join today</h2>
    </div>
    <div>
      <div class="container">
        <button  class="google-signup"> <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg">Sign up with Google</button>
      </div>
      <div class="container">
        <button class="apple-signup"> <span><font-awesome-icon :icon="['fab', 'apple']" size="2xl" /></span>Sign up with Apple</button>
      </div>
      <div class="line">
        <div class="left"></div>
        <span class="text">or</span>
        <div class="right"></div>
      </div>
      <div class="container">
        <button class="create-account" @click="$emit('create-account')">Create account</button>
      </div>
      <div class="container">
        <p class="text">Already have an account?</p>
      </div>
      <div class="container">
        <button class="sign-in">Sign in</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'login',
};
</script>
<style lang="scss" scoped>

</style>

