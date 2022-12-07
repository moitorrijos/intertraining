describe('Logging in', () => {
  const username = 'test@intermaritime.org'
  const password = 'aXZIrdtJi5$F^uxP75E$zuNy'

  context('HTML form submission', () => {
    beforeEach(() => {
      cy.visit('/');
    })
    it('logs in successfully', () => {
      cy.get('input[name="pmtsc_user_login"]').type(username)
      cy.get('input[name="pmtsc_user_pass"]').type(`${password}{enter}`)
      cy.url().should('include', '/modules')
    })
  })

  // it('passes', () => {
  //   cy.visit('https://example.cypress.io')
  // })
})