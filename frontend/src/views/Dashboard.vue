<template>
  <div>
    <WidgetsDropdown/>
    <CCard>
      <CCardBody>
        <CRow>
          <CCol sm="5">
            <h4 id="traffic" class="card-title mb-0">All accounts</h4>
            <div class="small text-muted">Period here</div>
          </CCol>
        </CRow>
        <MainChartExample style="height:300px;margin-top:40px;"/>
      </CCardBody>
      <CCardFooter>
        <CRow class="text-center">
          <CCol md sm="12" class="mb-sm-2 mb-0">
            <div class="text-muted">Piggy 1</div>
            <strong>29.703 Users (40%)</strong>
            <CProgress
              class="progress-xs mt-2"
              :precision="1"
              color="success"
              :value="40"
            />
          </CCol>
          <CCol md sm="12" class="mb-sm-2 mb-0 d-md-down-none">
            <div class="text-muted">Piggy 2</div>
            <strong>24.093 Users (20%)</strong>
            <CProgress
              class="progress-xs mt-2"
              :precision="1"
              color="info"
              :value="20"
            />
          </CCol>
          <CCol md sm="12" class="mb-sm-2 mb-0">
            <div class="text-muted">Piggy 3</div>
            <strong>78.706 Views (60%)</strong>
            <CProgress
              class="progress-xs mt-2"
              :precision="1"
              color="warning"
              :value="60"
            />
          </CCol>
          <CCol md sm="12" class="mb-sm-2 mb-0">
            <div class="text-muted">Piggy 4</div>
            <strong>22.123 Users (80%)</strong>
            <CProgress
              class="progress-xs mt-2"
              :precision="1"
              color="danger"
              :value="80"
            />
          </CCol>
          <CCol md sm="12" class="mb-sm-2 mb-0 d-md-down-none">
            <div class="text-muted">Piggy 5</div>
            <strong>Average Rate (40.15%)</strong>
            <CProgress
              class="progress-xs mt-2"
              :precision="1"
              :value="40"
            />
          </CCol>
        </CRow>
      </CCardFooter>
    </CCard>
    <CRow>
      <CCol md="12">
        <CCard>
          <CCardHeader>
            Budgets and categories
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol sm="12" lg="6">
                <CRow>
                  <CCol sm="6">
                    <CCallout color="info">
                      <small class="text-muted">Spent in budgets</small><br>
                      <strong class="h4">9,123</strong>
                    </CCallout>
                  </CCol>
                  <CCol sm="6">
                    <CCallout color="danger">
                      <small class="text-muted">Outside budgets</small><br>
                      <strong class="h4">22,643</strong>
                    </CCallout>
                  </CCol>
                </CRow>
                <hr class="mt-0">
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 1
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      color="info"
                      :value="34"
                    />
                    <CProgress
                      class="progress-xs"
                      color="danger"
                      :value="78"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 2
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="56"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="94"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 3
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="12"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="67"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 4
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="43"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="91"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 5
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="22"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="73"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 6
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="53"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="82"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend">
                    <span class="progress-group-text">
                      Budget 7
                    </span>
                  </div>
                  <div class="progress-group-bars">
                    <CProgress
                      class="progress-xs"
                      :value="9"
                      color="info"
                    />
                    <CProgress
                      class="progress-xs"
                      :value="69"
                      color="danger"
                    />
                  </div>
                </div>
                <div class="legend text-center">
                  <small>
                    <sup><CBadge shape="pill" color="info">&mdash;</CBadge></sup>
                    LEgend1
                    &nbsp;&nbsp;
                    <sup><CBadge shape="pill" color="danger">&mdash;</CBadge></sup>
                    Legend2
                  </small>
                </div>
              </CCol>
              <CCol sm="12" lg="6">
                <CRow>
                  <CCol sm="6">
                    <CCallout color="warning">
                      <small class="text-muted">In cat</small><br>
                      <strong class="h4">78,623</strong>
                    </CCallout>
                  </CCol>
                  <CCol sm="6">
                    <CCallout color="success">
                      <small class="text-muted">No cat</small><br>
                      <strong class="h4">49,123</strong>
                    </CCallout>
                  </CCol>
                </CRow>
                <hr class="mt-0">
                <ul class="horizontal-bars type-2">
                  <div class="progress-group">
                    <div class="progress-group-header">
                      <CIcon name="cil-user" class="progress-group-icon"/>
                      <span class="title">Cat 1</span>
                      <span class="ml-auto font-weight-bold">43%</span>
                    </div>
                    <div class="progress-group-bars">
                      <CProgress
                        class="progress-xs"
                        :value="43"
                        color="warning"
                      />
                      <CProgress
                              class="progress-xs"
                              :value="43"
                              color="warning"
                      />
                    </div>
                  </div>
                  <div class="progress-group mb-5">
                    <div class="progress-group-header">
                      <CIcon name="cil-user-female" class="progress-group-icon"/>
                      <span class="title">Cat 2</span>
                      <span class="ml-auto font-weight-bold">37%  <span class="text-muted small">(11%)</span></span>
                    </div>
                    <div class="progress-group-bars">
                      <CProgress
                        class="progress-xs"
                        :value="37"
                        color="warning"
                      />
                    </div>
                  </div>





                </ul>
              </CCol>
            </CRow>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <!-- bla bla -->
    <CRow>
      <CCol md="12">
        <CCard>
          <CCardHeader>
            Bla bla
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol lg="6">
                <CTableWrapper
                        :items="getShuffledUsersData()"
                        small
                        caption="Condensed Table"
                />
              </CCol>

              <CCol lg="6">
                <CTableWrapper
                        :items="getShuffledUsersData()"
                        fixed
                        bordered
                        caption="Bordered Table"
                />
              </CCol>
            </CRow>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>


  </div>
</template>

<script>
import MainChartExample from './charts/MainChartExample'
import WidgetsDropdown from './widgets/WidgetsDropdown'
import usersData from "./users/UsersData";
import CTableWrapper from "./base/Table";

export default {
  name: 'Dashboard',
  components: {
    MainChartExample,
    WidgetsDropdown,
    CTableWrapper
  },
  data () {
    return {
      selected: 'Month',
      tableItems: [
        {
          avatar: { url: 'img/avatars/1.jpg', status: 'success' },
          user: { name: 'Yiorgos Avraamu', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'USA', flag: 'cif-us' },
          usage: { value: 50, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Mastercard', icon: 'cib-cc-mastercard' },
          activity: '10 sec ago'
        },
        {
          avatar: { url: 'img/avatars/2.jpg', status: 'danger' },
          user: { name: 'Avram Tarasios', new: false, registered: 'Jan 1, 2015' },
          country: { name: 'Brazil', flag: 'cif-br' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Visa', icon: 'cib-cc-visa' },
          activity: '5 minutes ago'
        },
        {
          avatar: { url: 'img/avatars/3.jpg', status: 'warning' },
          user: { name: 'Quintin Ed', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'India', flag: 'cif-in' },
          usage: { value: 74, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Stripe', icon: 'cib-stripe' },
          activity: '1 hour ago'
        },
        {
          avatar: { url: 'img/avatars/4.jpg', status: '' },
          user: { name: 'Enéas Kwadwo', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'France', flag: 'cif-fr' },
          usage: { value: 98, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'PayPal', icon: 'cib-paypal' },
          activity: 'Last month'
        },
        {
          avatar: { url: 'img/avatars/5.jpg', status: 'success' },
          user: { name: 'Agapetus Tadeáš', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Spain', flag: 'cif-es' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Google Wallet', icon: 'cib-google-pay' },
          activity: 'Last week'
        },
        {
          avatar: { url: 'img/avatars/6.jpg', status: 'danger' },
          user: { name: 'Friderik Dávid', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Poland', flag: 'cif-pl' },
          usage: { value: 43, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Amex', icon: 'cib-cc-amex' },
          activity: 'Last week'
        }
      ],
      tableFields: [
        { key: 'avatar', label: '', _classes: 'text-center' },
        { key: 'user' },
        { key: 'country', _classes: 'text-center' },
        { key: 'usage' },
        { key: 'payment', label: 'Payment method', _classes: 'text-center' },
        { key: 'activity' },
      ]
    }
  },
  methods: {
    shuffleArray (array) {
      for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1))
        let temp = array[i]
        array[i] = array[j]
        array[j] = temp
      }
      return array
    },

    getShuffledUsersData () {
      return this.shuffleArray(usersData.slice(0))
    },
    color (value) {
      let $color
      if (value <= 25) {
        $color = 'info'
      } else if (value > 25 && value <= 50) {
        $color = 'success'
      } else if (value > 50 && value <= 75) {
        $color = 'warning'
      } else if (value > 75 && value <= 100) {
        $color = 'danger'
      }
      return $color
    }
  }
}
</script>
