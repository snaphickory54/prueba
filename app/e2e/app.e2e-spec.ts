import { AutenticadorPage } from './app.po';

describe('autenticador App', () => {
  let page: AutenticadorPage;

  beforeEach(() => {
    page = new AutenticadorPage();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!!');
  });
});
